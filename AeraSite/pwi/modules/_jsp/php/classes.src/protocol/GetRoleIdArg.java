/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleIdArg extends Rpc.Data
/*    */ {
/*    */   public Octets rolename;
/*    */   public byte reason;
/*    */ 
/*    */   public GetRoleIdArg()
/*    */   {
/* 15 */     this.rolename = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.rolename);
/* 21 */     os.marshal(this.reason);
/* 22 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 27 */     os.unmarshal(this.rolename);
/* 28 */     this.reason = os.unmarshal_byte();
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 36 */       GetRoleIdArg o = (GetRoleIdArg)super.clone();
/* 37 */       o.rolename = ((Octets)this.rolename.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleIdArg
 * JD-Core Version:    0.6.2
 */