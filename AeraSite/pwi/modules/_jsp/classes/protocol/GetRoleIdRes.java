/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleIdRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.retcode);
/* 20 */     os.marshal(this.roleid);
/* 21 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 26 */     this.retcode = os.unmarshal_int();
/* 27 */     this.roleid = os.unmarshal_int();
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 35 */       return (GetRoleIdRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 39 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleIdRes
 * JD-Core Version:    0.6.2
 */