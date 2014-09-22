/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RenameRoleArg extends Rpc.Data
/*    */ {
/*    */   public int roleid;
/*    */   public Octets oldname;
/*    */   public Octets newname;
/*    */ 
/*    */   public RenameRoleArg()
/*    */   {
/* 16 */     this.oldname = new Octets();
/* 17 */     this.newname = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.roleid);
/* 23 */     os.marshal(this.oldname);
/* 24 */     os.marshal(this.newname);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.roleid = os.unmarshal_int();
/* 31 */     os.unmarshal(this.oldname);
/* 32 */     os.unmarshal(this.newname);
/* 33 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 40 */       RenameRoleArg o = (RenameRoleArg)super.clone();
/* 41 */       o.oldname = ((Octets)this.oldname.clone());
/* 42 */       o.newname = ((Octets)this.newname.clone());
/* 43 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 46 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RenameRoleArg
 * JD-Core Version:    0.6.2
 */