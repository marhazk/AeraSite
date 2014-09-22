/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class PreCreateRoleArg extends Rpc.Data
/*    */ {
/*    */   public int zoneid;
/*    */   public int userid;
/*    */   public int uselogic;
/*    */   public Octets rolename;
/*    */ 
/*    */   public PreCreateRoleArg()
/*    */   {
/* 17 */     this.rolename = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.zoneid);
/* 23 */     os.marshal(this.userid);
/* 24 */     os.marshal(this.uselogic);
/* 25 */     os.marshal(this.rolename);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 31 */     this.zoneid = os.unmarshal_int();
/* 32 */     this.userid = os.unmarshal_int();
/* 33 */     this.uselogic = os.unmarshal_int();
/* 34 */     os.unmarshal(this.rolename);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 42 */       PreCreateRoleArg o = (PreCreateRoleArg)super.clone();
/* 43 */       o.rolename = ((Octets)this.rolename.clone());
/* 44 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 47 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PreCreateRoleArg
 * JD-Core Version:    0.6.2
 */